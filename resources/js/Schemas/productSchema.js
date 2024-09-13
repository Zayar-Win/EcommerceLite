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
    price: yup
        .number()
        .required("Price is required")
        .positive("Price must be a positive number")
        .min(1, "Price must be at least 1"),
    discount: yup
        .number()
        .nullable()
        .min(0, "Discount must be at least 0")
        .max(100, "Discount cannot exceed 100"),
    category_id: yup
        .number()
        .required("Category is required")
        .integer("Category ID must be an integer"),
    images: yup.mixed().test("files", "You can upload under to 5 images only",value => {
        return Array.isArray(value) && value.length <= 5;
    })
    .nullable(),
});
