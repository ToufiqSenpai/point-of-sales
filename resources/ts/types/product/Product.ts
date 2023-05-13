interface Product extends Timestamp {
  id: number
  name: string
  description: string | null
  barcode: string | null
  sku: string | null
  base_price: number
  selling_price: number
  sold: number
  stock: number
  category_id: number
  unit_id: number
  brand_id: number
  image_id: number
}

export default Product