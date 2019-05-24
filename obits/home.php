<?php
require_once 'includes/header.php';

?>

<!--Jumbotron identifying what the page is-->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Lawrenceburg Public Library District</h1> 
            <h2>Obituaries</h2>
    </div>
</div>

<!--Carousel using Bootstrap 4-->
<div class='container'>
    <h3>Search for Obituaries:</h3><br/>

    <!--Search feature-->
    <form action="set_search.php" method="get" class="form-inline">
        <input class="form-control mr-sm-3" type="search" name="Last" placeholder="Search by Last Name" aria-label="Search">
        <input class="form-control mr-sm-3" type="search" name="First" placeholder="Search by First Name" aria-label="Search">
<!--        <input class="form-control mr-sm-3" type="search" name="Middle" placeholder="Search by Middle Name" aria-label="Search">
        <input class="form-control mr-sm-3" type="search" name="Maiden" placeholder="Search by Maiden Name" aria-label="Search">-->
<!--        <input class="form-control mr-sm-3" type="search" name="DeathDate" placeholder="Search by Death Date" aria-label="Search">
        <input class="form-control mr-sm-3" type="search" name="BirthDate" placeholder="Search by Birth Date" aria-label="Search">
        <input class="form-control mr-sm-3" type="search" name="Spouse" placeholder="Search by Spouse" aria-label="Search">
        <input class="form-control mr-sm-3" type="search" name="SurvivedBy" placeholder="Search Survived By" aria-label="Search">
        <input class="form-control mr-sm-3" type="search" name="Other" placeholder="Search by Other" aria-label="Search">
        <input class="form-control mr-sm-3" type="search" name="ObitSource" placeholder="Search by Obituary Source" aria-label="Search">
        <input class="form-control mr-sm-3" type="search" name="SourceDate" placeholder="Search by Source Date" aria-label="Search">-->
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
    </form>
    <br/>

    <br/>

    <!--Tentative information that the library would want users to know-->
<!--    <h2>Our Purpose</h2>
    <br/>

    <p>The Lawrenceburg Public Library District's intention with this site is to supplement 
        library patrons and staff with a reliable index. The index's design is to 
        enable users to discover the location of various miscellaneous and vertical files
        within the genealogy and local history department.
    </p>-->

</div>
<?php
require_once 'includes/footer.php';
