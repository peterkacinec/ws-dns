<div>
    <label for="type">Typ</label>
    <select name="type" id="type" v-model="DNSselected">
        <option v-for="option in DNSoptions" v-bind:value="option.id">
            {{ option.value }}
        </option>
    </select>
</div>
<div>
    <label for="name">pre adresu</label>
    <input id="name" type="text" name="name" value="<?= isset($data['name']) ? $data['name'] : null ?>"/>
</div>
<div>
    <label for="content">cielova IP</label>
    <input id="content" type="text" name="content" value="<?= isset($data['content']) ? $data['content'] : '' ?>"/>
</div>
<div>
    <label for="ttl">TTL</label>
    <input id="ttl" type="text" name="ttl" value="<?= isset($data['ttl']) ? $data['ttl'] : '' ?>"/>
</div>
<div>
    <label for="note">Poznamka</label>
    <input id="note" type="text" name="note" value="<?= isset($data['note']) ? $data['note'] : '' ?>"/>
</div>
<div v-if="DNSselected === 'MX' || DNSselected === 'SRV'">
    <label for="prio">Priorita</label>
    <input id="prio" type="text" name="prio" value="<?= isset($data['prio']) ? $data['prio'] : '' ?>"/>
</div>
<div v-if="DNSselected === 'SRV'">
    <label for="port">Cislo portu</label>
    <input id="port" type="text" name="port" value="<?= isset($data['port']) ? $data['port'] : '' ?>"/>
</div>
<div v-if="DNSselected === 'SRV'">
    <label for="weight">Váha</label>
    <input id="weight" type="text" name="weight" value="<?= isset($data['weight']) ? $data['weight'] : '' ?>"/>
</div>
<button type="submit">ulozit</button>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue!',
            DNSselected:'A',
            DNSoptions: [
                { id: 'A', value: 'A' },
                { id: 'AAAA', value: 'AAAA' },
                { id: 'MX', value: 'MX' },
                { id: 'ANAME', value: 'ANAME' },
                { id: 'CNAME', value: 'CNAME' },
                { id: 'NS', value: 'NS' },
                { id: 'TXT', value: 'TXT' },
                { id: 'SRV', value: 'SRV' },
            ]
        }
    })
</script>