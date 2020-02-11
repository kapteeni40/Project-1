<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
        <header>
            <div class="logo_container">
                <img class="logo" src="https://images3.memedroid.com/images/UPLOADED279/5bd6cc01a70a6.jpeg" alt="logo">
            </div>
            <div class="login_container">Login here possibly</div>
        </header>
        <div class="content_container">
            <div class="banner_1">
                <h2>BANNER</h2>
            </div>
            <table>
            <?php //while ($row = $result->fetch_assoc()): ?>
	            <tr>
		            <td><?php echo '<h3>Otsikko</h3><p>Esimerkkitekstiä</p>'; ?></td>
	            </tr>
	        <?php //endwhile; ?>
            </table>
            <div class="banner_2">
                <h2>BANNER</h2>
            </div>
        </div>
        <footer>
            <div class="contact_info"></div>
            <div class="social_media"></div>
        </footer>
    </body>
</html>