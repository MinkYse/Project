<?php
use App\Services\Page;
?>
<!doctype html>
<html lang="ru" class="">

<?php
Page::part('head');
?>
<body>
<?php
Page::part('navbar');
?>
<section class="page_404">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="col-sm-10 col-sm-offset-1  text-center">
                    <div class="four_zero_four_bg">
                        <h1 class="text-center ">404</h1>
                    </div>
                    <div class="contant_box_404">
                        <h3 class="h2">Кажется, что-то пошло не так!</h3>
                        <p>Страница не найдена!</p>
                        <a href="/" class="link_404">На главную</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
Page::part('footer');
?>
</body>
</html>
