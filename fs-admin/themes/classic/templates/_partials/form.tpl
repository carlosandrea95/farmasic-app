{$form}
<script>
   $(document).ready(function() {
      $('.chk').change(function() {
         if (this.checked)
            changeState(this.value, this.target);
         else
            changeState(this.value, this.target);
      });

      function changeState(value, target) {
         $.ajax({
            type: 'POST',
            url: target,
            data: formdata ? formdata : form.serialize(),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
               credit.attr('readonly', false);
               debit.attr('readonly', false);
               form.trigger('reset');
               $('#accounts').prop('selectedIndex', -1).trigger("change");
               fetch_lines();
            }
         });
      }
   });
</script>