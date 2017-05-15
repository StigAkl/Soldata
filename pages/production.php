

    <?php

    $page = "chart_days.php";

    if(isset($_GET['graph'])) {
        $site = htmlspecialchars($_GET['graph']);
        switch ($site) {
            case "day":
                $page = "chart_days.php";
                break;
            case "month":
                $page = "chart_month.php";
                break;
            default:
                $page = "chart_days.php";
        }
    }

    include ($page);

    ?>