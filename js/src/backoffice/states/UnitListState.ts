import AbstractListState from 'flamarkt/backoffice/common/states/AbstractListState';
import Unit from '../../common/models/Unit';

export default class UnitListState extends AbstractListState<Unit> {
    type() {
        return 'flamarkt/units';
    }
}
