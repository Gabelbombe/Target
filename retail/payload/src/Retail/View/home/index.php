<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Products</title>
    <meta name="description" content="Generic PHP getter." />
    <meta name="author" content="Jd Daniel" />

    <link rel="stylesheet" type="text/css" href="/assets/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css" />
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/modernizr.js"></script>
</head>
<body>
    <div class="product">
        <header>
            <hgroup>
                <h1>Products</h1>
                <h4>Our list of procuts</h4>
            </hgroup>
        </header>

        <?php foreach($products AS $product) { ?>

        <section>

            <p><img class="micro" src="/assets/img/<?php echo str_replace('-',strtolower($product['title'])); ?>.png"><?php echo "<a href='/product/{$product['id']}'>{$product['title']}</a>" ?></p>

        </section>

        <?php } ?>
    </div>
</body>
</html>

