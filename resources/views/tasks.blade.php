<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Task App</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
    body {
    background-color: #ffe6f0; /* baby pink background */
    font-family: 'Poppins', sans-serif; /* ✨ use Poppins */
    color: #5c3c4d;
    margin: 0;
    padding: 20px;
    }


    h1 {
        color: #d63384; /* darker pink for headings */
        text-align: center;
        margin-bottom: 30px;
    }

    input[type="text"] {
        padding: 8px;
        width: 250px;
        border: 1px solid #f5b5c9;
        border-radius: 5px;
        margin-right: 10px;
    }

    button {
        padding: 8px 12px;
        background-color: #f5b5c9; /* soft pink */
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #d63384; /* darker pink on hover */
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        background-color: white;
        margin: 10px 0;
        padding: 12px;
        border-radius: 10px;
        display: flex;
        align-items: left;
        justify-content: space-between;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .task-text {
        flex-grow: 1;
    }

    .task-button {
        background: none;
        border: 2px solid #f5b5c9;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        font-size: 16px;
        color: #d63384;
        cursor: pointer;
        margin-left: 10px;
        transition: all 0.3s ease;
    }

    .task-button:hover {
        background-color: #f5b5c9;
        color: white;
    }

    .fade-out {
        opacity: 0;
        transition: opacity 0.5s ease-out;
    }

    .task-item {
    transition: all 0.5s ease; /* smooth transition */
    }

.task-item.completed {
    opacity: 0;
    transform: scale(0.9);
   }

   @keyframes dreamyEffect {
    0% { transform: scale(1); opacity: 0.5; }
    100% { transform: scale(1.1); opacity: 1; }
}

@keyframes fadeOut {
    0% { opacity: 1; }
    100% { opacity: 0; transform: translateY(-20px); }
}
</style>


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

    <ul id="taskList" style="list-style-type: none; padding: 0;">
    @foreach ($tasks as $task)
    <li id="task-{{ $task->id }}" style="margin-bottom: 10px; display: flex; align-items: center;">
            <button 
                onclick="completeTask({{ $task->id }})"
                style="width: 30px; height: 30px; border: 2px solid black; border-radius: 50%; background: none; cursor: pointer; margin-right: 10px; font-size: 20px;">
                
            </button>
            {{ $task->task }}
        </li>
    @endforeach
</ul>

</body>

<script>
    function completeTask(taskId) {
        const button = document.querySelector(`#task-${taskId} button`);
        const taskItem = document.getElementById(`task-${taskId}`);

        // Add dreamy effect by changing button content first
        button.innerHTML = '❤️'; // Show tick (can also add a dreamy animation here if needed)

        // Add 'completed' class for animation
        taskItem.classList.add('completed'); // dreamy effect first

        setTimeout(() => {
            // Send the DELETE request after the animation starts
            fetch(`/tasks/${taskId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    taskItem.classList.add('fade-out'); // Add fade-out class for smooth removal

                    // Remove task from DOM after fade-out animation
                    setTimeout(() => {
                        taskItem.remove();
                    }, 500); // Wait for fade-out animation to complete
                } else {
                    alert('Failed to complete task!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong.');
            });
        }, 300); // Wait 300ms after tick for the dreamy effect
    }
</script>



</html>