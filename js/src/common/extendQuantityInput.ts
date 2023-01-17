import {override} from 'flarum/common/extend';
import QuantityInput from 'flamarkt/core/common/components/QuantityInput';

export default function () {
    override(QuantityInput.prototype, 'unitLabel', function () {
        const unit = this.attrs.unit || this.attrs.product?.attribute('unit');

        if (unit === 'g') {
            return 'g';
        }

        return 'pcs';
    });
}
