<table>
    <thead>
        <tr>
            <td>type</td>
            <td>id</td>
            <td>Pre adresu</td>
            <td>cielova IP</td>
            <td>ttl</td>
            <td>note</td>
            <td>action</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data['items'] as $d): ?>
        <tr>
            <td><?= $d['type'] ?></td>
            <td><?= $d['id'] ?></td>
            <td><?= $d['name'] .'.'. DOMAIN_NAME ?></td>
            <td><?= $d['content'] ?></td>
            <td><?= $d['ttl'] ?></td>
            <td><?= $d['note'] ?></td>
            <td>
                <button type="button"><a href="/edit?id=<?= $d['id']?>">edit</a></button>
                <form action="/delete?id=<?= $d['id']?>" method="post"><button type="submit">delete</button></form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>