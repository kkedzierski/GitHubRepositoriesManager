<script 
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    <script src="./static/script.js?v=<?= time(); ?>"></script>
    <?php if(isset($errorCodes)): ?>
        <script>
            let errorStatusDesc = getErrorStatusDescription(<?= $errorCodes[0] ?>);
            showToast("error", errorStatusDesc, "bottom-center");
        </script>
        <?php unset($_SESSION['errorCodes']); ?>
    <?php elseif(isset($_SESSION['repositoryCreated'])): ?>
        <script>
            showToast("success", "Repository Created", "bottom-center");
        </script>
        <?php unset($_SESSION['repositoryCreated']); ?>
    <?php elseif(isset($_SESSION['repositoryUpdated'])): ?>
        <script>
            showToast("success", "Repository Updated", "bottom-center");
        </script>
        <?php unset($_SESSION['repositoryUpdated']); ?>
    <?php elseif(isset($_SESSION['repositoryDeleted'])): ?>
        <script>
            showToast("success", "Repository Deleted", "bottom-center");
        </script>
        <?php unset($_SESSION['repositoryDeleted']); ?>
    <?php endif; ?>

</body>
</html>