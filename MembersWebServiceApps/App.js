import {
  createStackNavigator,
} from 'react-navigation';

import IndexScreen from './IndexScreen.js';
import ShowScreen from './ShowScreen.js';
import StoreScreen from './StoreScreen.js';
import UpdateScreen from './UpdateScreen.js';

export default createStackNavigator( {
  Index: {
    screen: IndexScreen,
  },
  Show: {
    screen: ShowScreen,
  },
  Store: {
    screen: StoreScreen,
  },
  Update: {
    screen: UpdateScreen,
  },
}, {
  initialRouteName: 'Index',
  navigationOptions: {
    headerStyle: {
      backgroundColor: '#a80000',
    },
    headerTintColor: '#fff',
    headerTitleStyle: {
      fontWeight: 'bold',
    },
  },
});
