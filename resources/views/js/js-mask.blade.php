<script type="text/javascript">
    $(document).ready(function () {
        $('#placa').mask('ZZZ-0000', {
            translation: {
                'Z': {
                    pattern: /[a-z]/, optional: false
                }
            }
        });
    });
</script>