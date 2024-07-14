<div>
    {{ $this->table }}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.addEventListener('copyToClipboard', event => {
            const url = event.detail.url;
            const el = document.createElement('textarea');
            el.value = url;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            alert('Copied URL: ' + url);
            
        });
    });
</script>
