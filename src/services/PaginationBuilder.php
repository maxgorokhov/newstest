<?php

namespace App\services;

class PaginationBuilder
{
    public static function  build(int $currentPage, int $totalPages, string $baseUrl)
    {

        //Ессли общее количество страниц меньше или равно 1
        if ($totalPages <= 1) return;


        //По сколько страниц показывать вокруг текущей
        $range = 1;

        //Страница слева от текущей
        $start = max(1, $currentPage - $range);

        //Страница справа от текущей
        $end = min($totalPages, $currentPage + $range);

        $html = [];

        //Кнопка назад
        if ($currentPage > 1) {
            $html[] = '<a href="'.$baseUrl.'news/' . ($currentPage - 1) . '" class="pagination__arrows">
                            <svg class="pagination__arrow-svg" width="16.76" height="13.32" >
                                <path  fill-rule="evenodd" d="m3.41 7.66 3.95 3.95c.4.39.4 1.01 0 1.41a.98.98 0 0 1-1.41 0L.29 7.36a1 1 0 0 1 0-1.41L5.95.29a1 1 0 0 1 1.41 0c.4.4.4 1.02 0 1.42L3.41 5.66h12.35c.56 0 1 .44 1 1s-.44 1-1 1H3.41Z"/>
                            </svg>
                        </a>';
        }

        //Вывод ссылки на 1 страницу и ... если нужно
        if ($start > 1) {
            $html[] = '<a href="'.$baseUrl.'news/1" class="pagination__link">1</a>';
            if ($start > 2) {
                $html[] = '<span class="pagination__ellipsis">...</span>';
            }
        }

        //Вывод основных ссылок
        for ($i = $start; $i <= $end; $i++) {
            if ($i == $currentPage) {
                $html[] = '<span class="pagination__active">'.$i.'</span>';
            } else {
                $html[] = '<a href="'.$baseUrl.'news/'.$i.'" class="pagination__link">'.$i.'</a>';
            }

        }

        //Вывод ссылки на последнюю страницу и ... если нужно

        if ($end < $totalPages) {
            if ($end < $totalPages - 1) {
                $html[] = '<span class="pagination__ellipsis">...</span>';
            }
            $html[] = '<a href="'.$baseUrl.'news/'.$totalPages.'" class="pagination__link">'.$totalPages.'</a>';
        }

        //Кнопка вперед
        if ($currentPage < $totalPages) {
            $html[] = '<a href="'.$baseUrl.'news/' . ($currentPage + 1) . '" class="pagination__arrows">
                        <svg class="pagination__arrow-svg" width="16.76" height="13.32" >
                            <path  fill-rule="evenodd" d="M13.34 5.66 9.39 1.71a.99.99 0 0 1 0-1.42 1 1 0 0 1 1.41 0l5.66 5.66c.4.39.4 1.02 0 1.41l-5.66 5.66a.98.98 0 0 1-1.41 0 .98.98 0 0 1 0-1.41l3.95-3.95H1c-.57 0-1-.44-1-1s.43-1 1-1h12.34Z"/>
                        </svg>
                       </a>';
        }

        return implode(' ', $html);
    }
}

