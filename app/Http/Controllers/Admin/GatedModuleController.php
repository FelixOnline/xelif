<?php


namespace App\Http\Controllers\Admin;


use A17\Twill\Http\Controllers\Admin\ModuleController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

/**
 * GatedModuleController implements the user permission policies in accessing CRUD entities
 * (articles, issues, sections, writers). This is done via overriding the methods in ModuleController
 * and adding additional behaviours to them
 */
class GatedModuleController extends ModuleController
{
    /**
     * The policy here is:
     * If the user has `live-change` permissions, we don't need to gate anything
     * Otherwise, if the entity is published, we forbid making changes to them,
     * including unpublishing;
     * but we allow changes to be made on draft entities.
     *
     * @param int $id
     * @param int|null $submoduleId
     * @return JsonResponse
     */
    public function update($id, $submoduleId = null): JsonResponse
    {
        if (Gate::allows('live-change')) {
            // If we can make any live change, we don't need to do further checks
            return parent::update($id, $submoduleId);
        } else {
            $input = $this->request->all();
            $item = $this->repository->getById($submoduleId ?? $id);
            if ($input['published']) {
                // We are make the item live, along with whatever change we have made. Block
                return $this->respondWithError(
                    $this->modelTitle . ' was not published. You do not have the permission to make live changes to ' . strtolower(
                        $this->moduleName
                    )
                );
            } else {
                if ($item->published) {
                    // we are trying to unpubish a published item. Block
                    return $this->respondWithError(
                        $this->modelTitle . ' was not unpublished. You do not have the permission to make live changes to ' . strtolower(
                            $this->moduleName
                        )
                    );
                }
                // We are editing a draft, allow.
                return parent::update($id, $submoduleId);
            }
        }
    }

    public function destroy($id, $submoduleId = null)
    {
        if (Gate::allows('live-change')) {
            // If we can make any live change, we don't need to do further checks
            return parent::destroy($id, $submoduleId);
        } else {
            $item = $this->repository->getById($submoduleId ?? $id);
            if ($item->published) {
                // Otherwise, we don't allow the deletion of a live item
                return $this->respondWithError(
                    $this->modelTitle . ' was not deleted. You do not have the permission to make live changes to ' . strtolower(
                        $this->moduleName
                    )
                );
            } else {
                // But we allow the deletion of a draft item
                return parent::destroy($id, $submoduleId);
            }
        }
    }


}
