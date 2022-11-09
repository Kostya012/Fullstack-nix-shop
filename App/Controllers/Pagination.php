<?php

/**
 *  class for generating pagination
 */
class Pagination
{
    /**
     * @var int page navigation links
     */
    private $max = 10;

    /**
     * @var string the key for the GET, in which the page number is written
     */
    private $index = 'page';

    /**
     * @var int current page
     */
    private $current_page;

    /**
     * @var int total number of records
     */
    private $total;

    /**
     * @var float entries per page (records on 1 page)
     */
    private $limit;

    /**
     * @var int count page
     */
    private $amount;

    /**
     * launching the necessary data for navigation
     * @param $total int total number of records
     * @param $current_page int current page
     * @param $limit float limit records on 1 page
     * @param $index string the key for the GET, in which the page number is written
     */
    public function __construct($total, $current_page, $limit, $index = '/products/notebooks/page-1')
    {
        # install total number of records
        $this->total = $total;

        # install current page
        $this->current_page = $current_page;

        # install limit records on 1 page
        $this->limit = $limit;

        # install the key for the GET, in which the page number is written
        $this->index = $index;

        # install current page
        $this->amount = $this->amount();
    }

    /**
     * For show links
     * @return string
     */
    public function get()
    {
        # for records links
        $links = null;

        # get limits for cycle
        $limits = $this->limits();

        $html = '<ul class="pagination-ul">';
        # generation links
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            # if current this current page, links not and add class active
            if ($page == $this->current_page) {
                $links .= '<li class="pagination-active"><a href="">' . $page . '</a></li>';
            } else {
                # else generation links
                $links .= $this->generateHtml($page);
            }
        }

        # if links created
        if (!is_null($links)) {
            # if current page not first
            if ($this->current_page > 1) {
                # create links "to first"
                $links = $this->generateHtml(1, '<<') . $links;
            }
            # if current page not first
            if ($this->current_page < $this->amount) {
                # create links "to last"
                $links .= $this->generateHtml($this->amount, '>>');
            }
        }

        $html .= $links . '</ul>';

        # return html
        return $html;
    }

    /**
     * For generation HTML-code links
     * @param int $page - number page
     * @param $text
     * @return string
     */
    private function generateHtml($page, $text = null)
    {
        # if link text is not specified
        if (!$text) {
            # specification, text is number page
            $text = $page;
        }
        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/');
        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);
        # bield HTML code links and return
        return
            '<li><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';
    }

    /**
     *  Для получения, откуда стартовать
     *
     * @return массив с началом и концом отсчёта
     */
    private function limits()
    {
        # Вычисляем ссылки слева (чтобы активная ссылка была посередине)
        $left = $this->current_page - round($this->max / 2);

        # Вычисляем начало отсчёта
        $start = $left > 0 ? $left : 1;

        # Если впереди есть как минимум $this->max страниц
        if ($start + $this->max <= $this->amount()) {
            # Назначаем конец цикла вперёд на $this->max страниц или просто на минимум
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            # Конец - общее количество страниц
            $end = $this->amount();

            # Начало - минус $this->max от конца
            $start = $this->amount() - $this->max > 0 ? $this->amount() - $this->max : 1;
        }

        # Возвращаем
        return
            array($start, $end);
    }

    /**
     * Для установки текущей страницы
     *
     * @return
     */
    private function setCurrentPage($currentPage)
    {
        # Получаем номер страницы
        $this->current_page = $currentPage;

        # Если текущая страница боле нуля
        if ($this->current_page > 0) {
            # Если текунщая страница меньше общего количества страниц
            if ($this->current_page > $this->amount) {
                # Устанавливаем страницу на последнюю
                $this->current_page = $this->amount;
            }
        } else {
            # Устанавливаем страницу на первую
            $this->current_page = 1;
        }
    }

    /**
     * Для получеия общего числа страниц
     *
     * @return число страниц
     */
    private function amount()
    {
        # Делим и возвращаем
        return round($this->total / $this->limit);
    }
}