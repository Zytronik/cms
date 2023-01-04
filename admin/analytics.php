<?php include 'includes/header.php';
include '../dbConfig.php'; ?>

<main class="content-wrapper">
    <article class="cockpit">
        <section>
            <div class="container-large">
                <div class="row">
                    <div class="col-12">
                        <h1>Statistiken</h1>
                    </div>
                </div>
            </div>
            <div class="container-large">
                <div class="row spark-row">
                    <div class="col-4">
                        <div class="chart onlineVisitorChart">
                            <div class="chart-info">
                                <span>2</span><br>
                                <p>Aktive Besucher</p>
                            </div>
                            <div id="onlineVisitorChart"></div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="chart browserChart">
                            <div title="Firefox">
                                <i class="fa-brands fa-firefox-browser"></i>
                                <span class="firefox">0</span>
                            </div>
                            <div title="Chrome">
                                <i class="fa-brands fa-chrome"></i>
                                <span class="chrome">0</span>
                            </div>
                            <div title="Safari">
                                <i class="fa-brands fa-safari"></i>
                                <span class="safari">0</span>
                            </div>
                            <div title="Edge">
                                <i class="fa-brands fa-edge"></i>
                                <span class="edge">0</span>
                            </div>
                            <div title="Opera">
                                <i class="fa-brands fa-opera"></i>
                                <span class="opera">0</span>
                            </div>
                            <div title="Brave">
                                <img src="../img/brave.svg">
                                <span class="brave">0</span>
                            </div>
                            <div title="Other Browsers">
                                <i class="fa-solid fa-window-restore"></i>
                                <span class="other">0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="chart visitorChart">
                            <div id="visitorChart"></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="chart countryChart">
                            <div id="countryChart"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="chart linkChart">
                            <div id="linkChart"></div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="chart totalTimeChart">
                            <div id="totalTimeChart"></div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="chart mobileChart">
                            <div id="mobileChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
</main>
<script>
    var data = [
        <?php $analytics = "SELECT * FROM analytics";
        $analytics = $conn->query($analytics);
        while ($analytics_row = $analytics->fetch_assoc()) {
            echo json_encode($analytics_row) . ",";
        } ?>
    ];
    
    function cleanLink(link){
        link = link.replace("<?php echo get_directory_url(); ?>", "");
        link = link.replace("https:", "");
        return link.replace("http:", "");
    }
</script>
<script defer src="js/analytics.js"></script>
<?php include 'includes/footer.php'; ?>