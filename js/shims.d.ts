import ProductShowPage from 'flamarkt/core/backoffice/pages/ProductShowPage';

declare module 'flamarkt/core/backoffice/pages/ProductShowPage' {
    export default interface ProductShowPage {
        unit: string | null
        amountMin: number | null
        amountMax: number | null
        amountStep: number | null
    }
}
