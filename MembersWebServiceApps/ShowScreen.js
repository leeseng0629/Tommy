import React, { Component } from 'react';
import {
  Alert,
  View,
  ScrollView,
  Image,
  StyleSheet,
} from 'react-native';
import {
  InputWithLabel
} from './UI.js';
import { FloatingAction } from 'react-native-floating-action';

// Define the floating-action component...
const actions = [{
  text: 'Edit',
  color: '#c80000',
  icon: require('./images/baseline_edit_white_18dp.png'),
  name: 'edit',
  position: 2,
}, {
  text: 'Delete',
  color: '#a80000',
  icon: require('./images/baseline_delete_white_18dp.png'),
  name: 'delete',
  position: 1,
}]

let config = require('./Config.js');
let common = require('./CommonData.js');

type Props = {};
export default class ShowScreen extends Component<Props> {
  static navigationOptions = ({navigation}) => {
    return {
      title: navigation.getParam('headerTitle')
    };
  };

  constructor(props) {
    super(props);

    this.state = {
      id: this.props.navigation.getParam('id'),
      member: null,
    };

    this._load = this._load.bind(this);
    this._delete = this._delete.bind(this);
  }

  componentDidMount() {
    this._load();
  }

  _load() {
    let url = config.settings.serverPath + '/api/members/' + this.state.id;

    fetch(url)
    .then( (response) => {
      if(!response.ok) {
        Alert.alert('Error', response.status.toString());
        throw Error('Error ' + response.status);
      }

      return response.json();
    })
    .then( (member) => {
      this.setState({member});
    })
    .catch( (error) => {
      console.error(error);
    });
  }

  _delete() {
    Alert.alert('Confirm Deletion', 'Delete `' + this.state.member.name + '`?', [
      {
        text: 'No',
        onPress: () => {},
      },
      {
        text: 'Yes',
        onPress: () => {
          let url = config.settings.serverPath + '/api/members/' + this.state.id;

          fetch(url, {
            method: 'DELETE',
            headers: {
              Accept: 'application/json',
              'Content-type': 'application/json',
            },
            body: JSON.stringify({
              id: this.state.id
            }),
          })
          .then( (response) => {
            if(!response.ok) {
              Alert.alert('Error', response.status.toString());
              throw Error('Error ' + response.status);
            }

            return response.json();
          })
          .then( (responseJson) => {
            if(responseJson.affected == 0) {
              Alert.alert('Error deleting record');
            }

            this.props.navigation.getParam('refresh')();
            this.props.navigation.goBack();
          })
          .catch( (error) => {
            console.error(error);
          });
        },
      },
    ], { cancelable: false });
  }

  render() {
    let member = this.state.member;

    return (
      <View style={styles.container}>

        <ScrollView>

          <InputWithLabel style={styles.output}
            label={'Name'}
            value={member ? member.name : ''}
            orientation={'vertical'}
            editable={false}
          />

          <InputWithLabel style={styles.output}
            label={'Email'}
            value={member ? member.email : ''}
            orientation={'vertical'}
            editable={false}
          />

          <InputWithLabel style={styles.output}
            label={'Phone'}
            value={member ? member.phone : ''}
            orientation={'vertical'}
            editable={false}
          />

          <InputWithLabel style={[styles.output, {height: 140, textAlignVertical: 'top'}]}
            label={'Address'}
            value={member ? member.address : ''}
            orientation={'vertical'}
            editable={false}
            multiline={true}
          />

          <InputWithLabel style={styles.output}
            label={'Postcode'}
            value={member ? member.postcode : ''}
            orientation={'vertical'}
            editable={false}
          />

          <InputWithLabel style={styles.output}
            label={'City'}
            value={member ? member.city : ''}
            orientation={'vertical'}
            editable={false}
          />

          <InputWithLabel style={styles.output}
            label={'State'}
            value={member ? common.getValue(common.states, member.state) : ''}
            orientation={'vertical'}
            editable={false}
          />

        </ScrollView>

        <FloatingAction
          actions={actions}
          color={'#a80000'}
          floatingIcon={(
            <Image
              source={require('./images/baseline_edit_white_18dp.png')}
            />
          )}
          onPressItem={ (name) => {
            switch(name) {
              case 'edit':
                this.props.navigation.navigate('Update', {
                  id: member ? member.id : 0,
                  headerTitle: member ? member.name : '',
                  refresh: this._load,
                  indexRefresh: this.props.navigation.getParam('refresh'),
                });
                break;

              case 'delete':
                this._delete();
                break;
            }
          }}
        />

      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 20,
    backgroundColor: '#fff',
  },
  output: {
    fontSize: 24,
    color: '#000099',
    marginTop: 10,
    marginBottom: 10,
  },
});
