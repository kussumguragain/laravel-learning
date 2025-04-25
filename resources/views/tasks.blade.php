<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Task App</title>
</head>
<body>
    <h1>My Task App 🧾 </h1>
     <!-- Form to add tasks -->
     <form action="/tasks" method="POST">
        @csrf
        <input type="text" name="task" placeholder="Enter a task" required>
        <button type="submit">Save Task</button>
    </form>

    <h2>Task List</h2>
    <ul>
        @foreach($tasks as $task)
            <li>{{ $task->task }}</li>
        @endforeach
    </ul>
</body>
</html>