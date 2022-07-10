<?php
use App\Services\Page;
?>
<!doctype html>
<html lang="ru" class="">

<?php
Page::part('head');
?>
<script>
    let session = "<?php
        if (isset($_SESSION['user'])) {
            echo 'true';
        } else {
            echo 'false';
        };
        ?>";
</script>
<header>
<body>
<?php
Page::part('navbar');
?>
    <div class="container-fluid carousel ">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/assets/img/1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block " style="background-color: rgba(0, 0, 0, 0.6);">
                        <h1 class="mb-3">My-Home</h1>
                        <h4 class="mb-3">Какой-то текс №1</h4>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/assets/img/2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block " style="background-color: rgba(0, 0, 0, 0.6);">
                        <h1 class="mb-3">My-Home</h1>
                        <h4 class="mb-3">Какой-то текс №2</h4>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/assets/img/3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block " style="background-color: rgba(0, 0, 0, 0.6);">
                        <h1 class="mb-3">My-Home</h1>
                        <h4 class="mb-3">Какой-то текс №3</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<main>
    <section>
        <div class="container" id="filters">
            <div class="row"">
                <div class="col-md-4">
                    <h4>Сортировка:</h4>
                    <br>
                    <select id="sort" name="sort" class="form-control">
                        <option value="price_asc">По цене, сначала дешевые</option>
                        <option value="price_desc">По цене, сначала дорогие</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <section class="main-content">
        <div class="container hide">
            <div class="row d-flex justify-content-center">
                <button type="button" class="btn btn-primary col-md-8" data-bs-toggle="modal" data-bs-target="#createProduct">Создать объявление</button>
            </div>
            <div class="modal fade" id="createProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-secondary text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Создание нового обьявления</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="create-entry" enctype="multipart/form-data">
                                <div class="mb-3 container">
                                    <label for="title" class="col-form-label">Название</label>
                                    <input type="text" placeholder="Введите название" name="title" class="form-control" id="title">
                                </div>
                                <div class="mb-3 container">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="description" placeholder="Leave a comment here" id="description" style="height: 100px"></textarea>
                                        <label for="description">Описание</label>
                                    </div>
                                </div>
                                <div class="mb-3 container">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="street" class="col-form-label">Улица</label>
                                            <input type="text" placeholder="" name="street" class="form-control" id="street">
                                        </div>
                                        <div class="col-4">
                                            <label for="house_number" class="col-form-label">Дом</label>
                                            <input type="text" placeholder="" name="house_number" class="form-control" id="house_number">
                                        </div>
                                        <div class="col-4">
                                            <label for="apartment_number" class="col-form-label">Квартира</label>
                                            <input type="text" placeholder="" name="apartment_number" class="form-control" id="apartment_number">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 container">
                                    <label for="img-path" class="form-label">Фото</label>
                                    <input class="form-control" accept="image/*" type="file" id="img-path">
                                </div>
                                <div class="mb-3 container">
                                    <label for="price" class="col-form-label">Цена</label>
                                    <input type="text" placeholder="" name="price" class="form-control" id="price">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary create-btn">Создать</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-secondary text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Изменение обьявления</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="create-entry" enctype="multipart/form-data">
                                <div class="mb-3 container">
                                    <label for="edited-title" class="col-form-label">Название</label>
                                    <input type="text" placeholder="Введите название" name="edited-title" class="form-control"
                                           id="edited-title">
                                </div>
                                <div class="mb-3 container">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="edited-description"
                                                  placeholder="Leave a comment here" id="edited-description" style="height: 100px"></textarea>
                                        <label for="edited-description">Описание</label>
                                    </div>
                                </div>
                                <div class="mb-3 container">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="edited-street" class="col-form-label">Улица</label>
                                            <input type="text" placeholder="" name="edited-street" class="form-control" id="edited-street">
                                        </div>
                                        <div class="col-4">
                                            <label for="edited-house_number" class="col-form-label">Дом</label>
                                            <input type="text" placeholder="" name="edited-house_number" class="form-control" id="edited-house_number">
                                        </div>
                                        <div class="col-4">
                                            <label for="edited-apartment_number" class="col-form-label">Квартира</label>
                                            <input type="text" placeholder="" name="edited-apartment_number" class="form-control" id="edited-apartment_number">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 container">
                                    <label for="edited-img-path" class="form-label">Новое фото</label>
                                    <input class="form-control" accept="image/*" type="file" id="edited-img-path">
                                </div>
                                <div class="mb-3 container">
                                    <label for="edited-price" class="col-form-label">Цена</label>
                                    <input type="text" placeholder="" name="edited-price" class="form-control" id="edited-price">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary edited-btn">Сохранить</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" id="cards">

            </div>
        </div>
    </section>
</main>
<?php
Page::part('footer');
?>
<script src="/assets/js/read_estate.js"></script>
<script src="/assets/js/create_entry.js"></script>
<script src="/assets/js/delete.js"></script>
<script src="/assets/js/edit.js"></script>
</body>
</html>
