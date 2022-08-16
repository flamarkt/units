import Unit from '../common/models/Unit';
import {forum} from './compat';
import {common} from '../common/compat';

export {
    forum,
    common,
};

app.initializers.add('flamarkt-units', () => {
    app.store.models['flamarkt-units'] = Unit;
});
