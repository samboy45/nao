/**
 * Created by 17014 on 28/05/2017.
 */

$(function () {
    $(document).on('change', '#validate_ordre, #validate_famille', function () {
        let $field = $(this);
        let $ordreField = $('#appbundle_observation_ordre');
        let $form = $field.closest('form');
        let target = '#' + $field.attr('id').replace('famille', 'espece').replace('ordre', 'famille');
        let data = {};
        data[$ordreField.attr('name')] = $ordreField.val();
        data[$field.attr('name')] = $field.val();
        $.post($form.attr('action'), data).then(function (data) {
            let $input = $(data).find(target);
            $(target).replaceWith($input)
        })
    });
});

$(function () {
    $(document).on('change', '#appbundle_observation_ordre, #appbundle_observation_famille', function () {
        let $field = $(this);
        let $ordreField = $('#appbundle_observation_ordre');
        let $form = $field.closest('form');
        let target = '#' + $field.attr('id').replace('famille', 'espece').replace('ordre', 'famille');
        let data = {};
        data[$ordreField.attr('name')] = $ordreField.val();
        data[$field.attr('name')] = $field.val();
        $.post($form.attr('action'), data).then(function (data) {
            let $input = $(data).find(target);
            $(target).replaceWith($input)
        })
    });
});
