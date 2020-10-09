<html>
    <head>
        <meta charset="utf-8" />
        <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&display=swap"
        rel="stylesheet" />
        <title>Felix Online</title>
        <meta name="description" content="Felix is the student newspaper of Imperial College London" />
        <style>
body
{
    font-family: 'EB Garamond', serif;
    font-size: 3.0em;
    background-color: #111;
    color: #ccc;
    display: flex;
    flex-direction: column;
}

body > *
{
    padding-left: 2rem;
    width: 60%;
    max-width: 45rem;
}

h1, h2
{
    font-weight: 400;
    margin: 0 0;
}

h2
{
    color: #888;
    font-size: 1.2em;
}

p
{
    font-style: italic;
    color: #333;

}
        </style>
    </head>
    <body>
        <h1>Felix<h1>
        <h2>The student newspaper of Imperial College London</h2>
        <p>@if($exception->getMessage()) {{ $exception->getMessage() }} @else Coming soon... @endif</p>
    </body>
</html>
