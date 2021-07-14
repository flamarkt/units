import AbstractListState from 'flamarkt/core/common/states/AbstractListState';

export default class UnitListState extends AbstractListState {
    type() {
        return 'flamarkt/units';
    }
}
