import * as yup from "yup";

export const productSchema = yup.object({
    name: yup
        .string()
        .required("Product name is required")
        .min(3, "Product name must be at least 3 characters long"),
    description: yup
        .string()
        .nullable()
        .max(500, "Description cannot exceed 500 characters"),
    category_id: yup
        .number()
        .required("Category is required")
        .integer("Category ID must be an integer"),
    images: yup.mixed().test("files", "You can upload under to 5 images only",value => {
        return Array.isArray(value) && value.length <= 5;
    })
    .nullable(),
});
