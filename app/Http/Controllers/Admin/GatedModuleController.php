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
     * If the user has `publish` permissions, we don't need to gate anything
     * Otherwise, if the entity is published, we forbid making changes to them;
     * but we allow changes to be made on draft entities.
     *
     * @param int $id
     * @param null $submoduleId
     * @return JsonResponse
     */
    public function update($id, $submoduleId = null): JsonResponse
    {
        if (Gate::allows('publish')) {
            // If we can publish, we don't need to do further checks
            return parent::update($id, $submoduleId);
        } else {
            $item = $this->repository->getById($submoduleId ?? $id);
            $input = $this->request->all();

            switch ($input['cmsSaveType']) {
                // TODO: respondWithError does not reset the slider on the front end.
                case 'publish':
                    return $this->respondWithError(
                        $this->modelTitle . ' was not published. You do not have the permission to publish a ' . strtolower($this->modelTitle)
                    );
                case 'save':
                case 'update':
                    if ($item->published) {
                        // We don't allow update of a published item as it will cause live changes
                        return $this->respondWithError(
                            $this->modelTitle . ' was not updated. You do not have the permission to update a live ' . strtolower($this->modelTitle)
                        );
                    } else {
                        // But we do allow update of a draft
                        return parent::update($id, $submoduleId);
                    }
                default:
                    return $this->respondWithError(
                        'unknown operation'
                    );
            }

        }
    }

}
