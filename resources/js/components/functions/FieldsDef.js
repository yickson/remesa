export const FieldsDef = [
    {
        name: 'name',
        sortField: 'name'
    },
    {
        name: 'email',
        title: 'Email Address'
    },
    {
        name: 'birthdate',
        sortField: 'birthdate',
        titleClass: 'center aligned',
        dataClass: 'center aligned',
    },
    {
        name: 'gender',
        sortField: 'gender',
        titleClass: 'center aligned',
        dataClass: 'center aligned',
        formatter (value) {
            return value === 'M' ? 'Male' : 'Female'
        }
    },
]