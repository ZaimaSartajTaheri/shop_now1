<style>
.side-menu {
    margin-top: 20px;
    color: #cc0000;

}

.title {
    background-color: #cc0000;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    padding: 5px;
    font-size: 20px;
    margin-bottom: 5px;
}

.categories {
    background-color: #f8d7da;
    border-radius: 5px;
    font-weight: bold;
}

.categories li {
    list-style-type: none;
}

.category-item a {
    text-decoration: none !important;
    display: flex;
    margin-top: 2px;
    color: black;
}

.category-item a:hover {
    color: #cc0000;
}
</style>
<div class="side-menu">
    <h6 class="title"><i class="icon fa fa-align-justify fa-fw"></i> Categories</h6>


    <ul class="categories">
        <li class="category-item">
            <?php $sql=mysqli_query($con,"select id,categoryName  from category");
while($row=mysqli_fetch_array($sql))
{
    ?>
            <a href="category.php?cid=<?php echo $row['id'];?>">
                <?php echo $row['categoryName'];?></a>
            <?php }?>
        </li>
    </ul>

</div>