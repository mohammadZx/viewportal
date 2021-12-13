const VueMyValidation = {
    // The install method is all that needs to exist on the plugin object.
    // It takes the global Vue object as well as user-defined options.
    install(Vue, options) {
        // We call Vue.mixin() here to inject functionality into all components.
        Vue.mixin({
            data() {
                return {
                    errors: [],
                }
            },
            methods: {
                vr: function(value, name) {
                    let em = `مقدار ${name} الزامی است`;
                    if (value == '' || value == null) {
                        this.errors.push(em);
                    } else {
                        this.errors = this.errors.filter(value => value != em);
                    }
                    return;
                },

                v_min_len: function(value, name, char) {
                    let em = `مقدار ${name} نباید کمتر از ${char} کاراکتر باشد`;
                    if (value != null && value.length < char) {
                        this.errors.push(em);
                    } else {
                        this.errors = this.errors.filter(value => value != em);
                    }
                    if (value == '') {
                        this.errors = this.errors.filter(value => value != em);
                    }
                    return;
                },
                v_max_len: function(value, name, char) {
                    let em = `مقدار ${name} نباید بیشتر از ${char} کاراکتر باشد`;
                    if (value != null && value.length > char) {
                        this.errors.push(em);
                    } else {
                        this.errors = this.errors.filter(value => value != em);
                    }
                    if (value == '') {
                        this.errors = this.errors.filter(value => value != em);
                    }
                    return;
                },
                unique: async function(value, stmt, name) {
                    let em = `مقدار ${name} تکراری است`;

                    await fetch('/api/v1/check-unique', {
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': window.csrf,
                            'Content-Type': 'application/json;charset=UTF-8'
                        },
                        body: JSON.stringify({
                            val: value,
                            stmt: stmt
                        })
                    }).then(res => res.json()).then(res => {
                        if (!res.result) {
                            this.errors.push(em);
                            return false;
                        } else {
                            this.errors = this.errors.filter(value => value != em);

                        }
                    });

                    return;


                },
                v_check_value_in: function(value, values, name) {
                    let em = `مقدار ${name} در مورد قبول نیست`;
                    let checkValues = values.filter(elm => elm == value);
                    let tmpchv = checkValues.length ? true : false;
                    if (!tmpchv) {
                        this.errors.push(em);
                    } else {
                        this.errors = this.errors.filter(value => value != em);
                    }
                    return;
                },

                v_get_errors: function() {
                    let uniqueArray = this.errors.filter(function(item, pos, self) {
                        return self.indexOf(item) == pos;
                    });
                    return uniqueArray;
                },

                v_error_check: function() {
                    if (this.errors.length) {
                        return false;
                    }
                    return true;
                }
            }
        });

    }
};

export default VueMyValidation;