<?php
// Handling submit
$url = 'https://hnrss.org/frontpage';
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $url = $_POST['url'];
};
?>

<html>
    <head>
        <link rel="stylesheet" href="styles.css">
        <title>RSS feed reader</title>
    </head>

    <body>
        <header>
            <form action="index.php" method="post">
                <input name="url" type="url" placeholder="Enter URL" > <br>
                <button type="submit">Submit</button>
            </form>
        </header>
        <hr>
        <main>
            <?php
                $content = @simplexml_load_file($url);
                if (!$content)
                {
                    die('<h2 style="text-align: center;">No stats.</h2>');
                }
                else
                {
                    echo '<ul>';
                    echo '<h2>' . $content
                        ->channel->title . '</h2> <br>';

                    foreach ($content
                        ->channel->item as $item)
                    {
                        echo "<li>";
                        echo "<h5>" . $item->title . "</h5>";
                        echo "<p>" . $item->description . "</p>";
                        echo "</li>";
                    }

                    echo "</ul>";
                }
            ?>
        </main>
    </body>
</html>
