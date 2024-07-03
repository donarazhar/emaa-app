<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bottom Navigation Bar</title>
    <link rel="stylesheet" href="style.css" />
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</head>

<body>
    <div class="bottom-bar">
        <ion-icon name="home-outline" class="icon" onclick="change(this)">
        </ion-icon>
        <ion-icon name="folder-outline" class="icon" onclick="change(this)">
        </ion-icon>
        <ion-icon name="add-circle-outline" class="icon active" onclick="change(this)">
        </ion-icon>
        <ion-icon name="person-outline" class="icon" onclick="change(this)">
        </ion-icon>
        <ion-icon name="image-outline" class="icon" onclick="change(this)">
        </ion-icon>
    </div>
</body>

</html>
<script>
    function change(item) {
        const buttons = document.querySelectorAll('ion-icon');
        buttons.forEach(function(obj) {
            obj.classList.remove("active");
        });
        item.classList.add("active");
    }
</script>
