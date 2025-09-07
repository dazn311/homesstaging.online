<div class="col-md-4">
    <h3>Текущие:</h3>
    <ul class="list-group">
        <?php foreach ($recent_posts as $recent_post) : ?>
            <li class="list-group-item">
                <a href="/?documents=<?=$recent_post['doc_id']; ?>">
                    <?=$recent_post['project_key']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>