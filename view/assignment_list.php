<?php include('view/header.php')?>
<section id="list" class="list">
    <header class="list__row list__header">
        <h1> Assignments </h1>
        <form action="." method="get" id="list__header__select" class="list__header__select">
            <input type="hidden" name="action" value="list_assignments">
            <select name="course_id" required>
                <option value="0"> View All <option>
                <?php foreach ($courses as $course) : ?>
                <?php if ($courseId = $course['courseID']) {?>
                    <option value="<?= $course['courseID']?>" selected> 
                <?php } else { ?>
                    <option value="<?= $course['courseID']?>"> 
                <?php } ?>
                        <?= $course['courseName'] ?>
                    </option>
                <?php endforeach ?>
            </select>
            <button class="add-button bold"> Go </button>
        </form>
    </header>
</section>
<?php include('view/footer.php')?>