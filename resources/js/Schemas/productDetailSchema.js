import * as yup from "yup";

export const productDetailSchema = yup.object({
    // variants: yup.array().of(
    //     yup.object().shape({
    //         qty: yup.number().required("Quantity is required"),
    //         price: yup.number().required("Price is required"),
    //         discount_price: yup.number().nullable(),
    //     })
    // ).required("At least one variant is required"),
    // attributes:yup.array().required('Attribute field is required'),
});