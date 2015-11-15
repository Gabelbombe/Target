<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Add a Product</title>
    <meta name="description" content="Generic PHP getter." />
    <meta name="author" content="Jd Daniel" />

    <link rel="stylesheet" type="text/css" href="/assets/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/form.css" />

    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/modernizr.js"></script>
</head>
    <div class="product">
        <header>
            <hgroup>
                <h1 class="">Add a Product</h1>
                <h4>You can add multiple features</h4>
            </hgroup>
        </header>

        <section class="body">
            <form action="/add" method="post">
                <label>Name</label>
                <input placeholder="Product Name" name="name" />

                <label>Blurb</label>
                <input placeholder="About the Product" name="blurb" maxlength=50 />

                <label>Description</label>
                <textarea placeholder="Products description" name="description"></textarea>

                <button>Create</button>

            </form>
        </section>
    </div>
</body>
</html>

