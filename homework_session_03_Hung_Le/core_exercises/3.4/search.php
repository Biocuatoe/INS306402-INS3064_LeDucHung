<!DOCTYPE html>
<html>
<body>
    <h2>Search Page</h2>
    <!-- Method GET puts data in URL -->
    <form method="GET">
        <input type="text" name="q" placeholder="Search..." 
               value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>">
        <button type="submit">Search</button>
    </form>

    <?php if (isset($_GET['q'])): ?>
        <h3>Results for: "<?php echo htmlspecialchars($_GET['q']); ?>"</h3>
        <p><i>(No real results, just demonstrating GET request)</i></p>
    <?php endif; ?>
</body>
</html>