<!doctype html>
<head>
    <meta charset="utf-8">
    <title><?php echo $product['title']; ?></title>
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
                <h1><?php echo $product['title']; ?></h1>
                <h4><?php echo $product['blurb']; ?></h4>
            </hgroup>
        </header>

        <figure>
            <img src="/assets/img/<?php echo str_replace(' ','-',strtolower($product['title'])); ?>.png" />
        </figure>

        <section>
            <p><?php echo $product['description']; ?></p>
            <details>
                <summary>Product Features</summary>
                <ul>
                    <?php foreach (json_decode($product['features']) AS $value)
                        echo "<li>{$value}</li>";
                    ?>
                </ul>
            </details>
            <button>Buy Now for <?php echo $product['price']; ?></button>
        </section>
     </div>
    <script>
        if ($('html').hasClass('no-details'))
        {
            var summary = $('details summary');

            summary.siblings().wrapAll('<div class="slide"></div>');

            $('details:not(.open) summary').siblings('div').hide();

            summary.click(function()
            {
                $(this).siblings('div').toggle();
                $('details').toggleClass('open');
            });
        }
    </script>
</body>
</html>

