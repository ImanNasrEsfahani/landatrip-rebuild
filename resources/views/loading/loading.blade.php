<div id="loading-container">
    <div class="loader"></div>
</div>
<script>
    window.addEventListener("DOMContentLoaded", (event) => {
        console.log("page is fully loaded");
        document.getElementById('loading-container').remove();
    });
</script>
