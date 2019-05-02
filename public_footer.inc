<?php
echo <<<HEREFOOT
<footer class="home">
    <p>&copy; <span id="year"></span>. Continental Quality</p>
    <p>Author: Randy McKissack</p>
</footer>
<script>
    var currentYear = new Date().getFullYear();
	var dateContainer = document.getElementById("year");
	dateContainer.innerHTML = currentYear;
</script>

</div> <!-- wrapper -->

</body>

</html>

HEREFOOT;
?>
