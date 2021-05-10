$().ready(function() {
    $('#form_cadastro').validate({
        rules: {
            nome: {
                required: true
            },
            descricao: {
                required: true
            },
            alunoId: {
                required: true
            },
            armarioId: {
                required: true
            },
            autorId: {
                required: true
            },
            editoraId: {
                required: true
            },
            esperaId: {
                required: true
            },
            generoId: {
                required: true
            },
            livroId: {
                required: true
            },
            penalidadeId: {
                required: true
            },
            turmaId: {
                required: true
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        messages: {
            nome: {
                required: "Este campo não pode ser vazio"
            },
            descricao: {
                required: "Este campo não pode ser vazio",
            },
            alunoId: {
                required: "Este campo não pode ser vazio",
            },
            armarioId: {
                required: "Este campo não pode ser vazio",
            },
            autorId: {
                required: "Este campo não pode ser vazio",
            },
            editoraId: {
                required: "Este campo não pode ser vazio",
            },
            esperaId: {
                required: "Este campo não pode ser vazio",
            },
            generoId: {
                required: "Este campo não pode ser vazio",
            },
            livroId: {
                required: "Este campo não pode ser vazio",
            },
            penalidadeId: {
                required: "Este campo não pode ser vazio",
            },
            turmaId: {
                required: "Este campo não pode ser vazio",
            }
        }
    });

    $('#form_cadastro').validate({
        rules: {
            nome: {
                required: true
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        messages: {
            nome: {
                required: "Este campo não pode ser vazio"
            }
        }
    });

    jQuery.extend(jQuery.validator.messages, {
        number: "Entre com um número válido.",
    });
});