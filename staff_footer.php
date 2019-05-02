<script>
function goBack() {
    window.history.back();
}
</script>
<footer>
  <p>&copy; <?php echo date('Y'); ?> Continental Quality</p>
  <p>Author: Randy McKissack</p>
</footer>
</div> <!-- content -->
</body>
</html>

<?php
  db_disconnect($db);
?>
