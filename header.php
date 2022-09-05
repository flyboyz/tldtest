<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php
        wp_title('|', true, 'right') ?></title>
    <?php
    wp_head(); ?>
</head>
<body id="body" <?php
body_class() ?>>
<header>
    <div class="top-line hidden-on-mobile">
        <div class="container">
            <ul class="menu">
                <li><a href="/wp-admin/">Войти</a></li>
                <li><a href="#">Зарегистрироваться</a></li>
            </ul>
            <div class="socials">
                <span>Наши соцсети</span>
                <a href="#"><span class="fa-vk"></span></a>
                <a href="#"><span class="fa-telegram"></span></a>
                <a href="#"><span class="fa-instagram"></span></a>
            </div>
        </div>
    </div>
    <div class="main hidden-on-mobile">
        <div class="container">
            <span class="logo">Ставки<span class="accent">.Спорт</span></span>
            <div class="banner">
                <img src="<?php
                echo get_stylesheet_directory_uri(); ?>/images/banner.png" alt="ad">
            </div>
        </div>
    </div>
    <div class="menu-line">
        <div class="mobile">
            <span class="logo">Ставки.Спорт</span>
            <div>
                <span class="fa-menu"></span>
                <span class="fa-search"></span>
            </div>
        </div>
        <div class="desktop">
            <div class="container">
                <ul class="menu">
                    <li><a href="#">Рейтинг букмекеров</a></li>
                    <li><a href="#">Бонусы и акции</a></li>
                    <li><a href="#">Отзывы</a></li>
                    <li><a href="#">Новости</a></li>
                    <li class="hide-on-tablet"><a href="#">Статьи</a></li>
                </ul>
                <ul class="fast-links">
                    <li class="youtube">
                        <a href="#">
                            <span class="fa-youtube-play"></span>
                            <span>Смотреть</span>
                        </a>
                    </li>
                    <li class="play-market hide-on-tablet">
                        <a href="#">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/play-market.png" alt="pm-logo">
                            <span>Приложение</span>
                        </a>
                    </li>
                    <li class="search">
                        <a href="#">
                            <span class="fa-search"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<main>