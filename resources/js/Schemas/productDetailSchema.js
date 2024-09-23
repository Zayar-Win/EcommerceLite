import * as yup from "yup";

export const productDetailSchema = yup.object({
    price: yup
        .number()
        .required("Price is required")
        .min(0, "Price must be a positive value"),
    discount: yup
        .number()
        .nullable()
        .min(0, "Discount must be a positive value")
        .max(100, "Discount cannot exceed 100%"),
    stock_quantity: yup
        .number()
        .required("Stock quantity is required")
        .min(0, "Stock quantity must be a positive value"),
    size_id:yup.array().required('Attribute field is required'),
});