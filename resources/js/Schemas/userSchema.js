import * as yup from 'yup';
import moment from 'moment';

export const userSchema = yup.object({
    name: yup.string().required('Display name is required').max(255, 'Name must not exceed 255 characters.'),
    email: yup.string().email('Enter a valid email').required('Email is required').matches(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/, 'Email must be in lowercase.'),
    phone: yup.string().required('Phone is required'),
    dob: yup.date().required('Date of birth is required')
    .max(new Date(), 'Date of birth cannot be in the future')
    .test('age', 'You must be at least 18 years old', value => {
        return moment().diff(moment(value), 'years') >= 18;
    }),
    address: yup.string().required('Address is required'),
    role_id: yup.string().required('Role is required'),
    password: yup.string().when('$mode', {
        is: 'create',
        then: yup.string().required('Password is required'),
    }),
    password_confirmation: yup.string().when('$mode', {
        is: 'create',
        then: yup.string().oneOf([yup.ref('password')], 'Passwords must match').required('Confirm password is required'),
    }),
});
