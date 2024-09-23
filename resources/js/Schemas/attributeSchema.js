
import * as yup from 'yup';

export const attributeSchema = yup.object({
    name: yup.string().required('Display name is required'),
    values: yup.array().of(
        yup.string().required('Value is required')
    ).min(1, 'At least one value is required'),
});
