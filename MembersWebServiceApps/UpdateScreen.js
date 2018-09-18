import React, { Component } from 'react';
import {
  Alert,
  StyleSheet,
  ScrollView,
  View,
} from 'react-native';
import {
  InputWithLabel,
  PickerWithLabel,
  AppButton,
} from './UI';

let config = require('./Config');
let common = require('./CommonData');

type Props = {};
export default class UpdateScreen extends Component<Props> {
  static navigationOptions = ({navigation}) => {
    return {
      title: 'Edit: ' + navigation.getParam('headerTitle')
    };
  };

  constructor(props) {
    super(props);

    this.state = {
      id: this.props.navigation.getParam('id'),
      name: '',
      email: '',
      phone: '',
      address: '',
      postcode: '',
      city: '',
      state: '14',
    };

    this._load = this._load.bind(this);
    this._update = this._update.bind(this);
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
      this.setState({
        name: member.name,
        email: member.email,
        phone: member.phone,
        address: member.address,
        postcode: member.postcode,
        city: member.city,
        state: member.state,
      });
    })
    .catch( (error) => {
      console.error(error);
    });
  }

  _update() {
    let url = config.settings.serverPath + '/api/members/' + this.state.id;

    fetch(url, {
      method: 'PUT',
      headers: {
        Accept: 'application/json',
        'Content-type': 'application/json',
      },
      body: JSON.stringify({
        id: this.state.id,
        name: this.state.name,
        email: this.state.email,
        phone: this.state.phone,
        address: this.state.address,
        postcode: this.state.postcode,
        city: this.state.city,
        state: this.state.state,
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
      if(responseJson.affected > 0) {
        Alert.alert('Record Updated', 'Record for `' + this.state.name + '` has been updated');
      }
      else {
        Alert.alert('Error updating record');
      }

      this.props.navigation.getParam('refresh')();
      this.props.navigation.getParam('indexRefresh')();
      this.props.navigation.goBack();
    })
    .catch( (errpr) => {
      console.error(error);
    })
  }

  render() {
    return (
      <ScrollView style={styles.container}>

        <InputWithLabel style={styles.input}
          label={'Name'}
          value={this.state.name}
          onChangeText={(name) => {this.setState({name})}}
          orientation={'vertical'}
        />

        <InputWithLabel style={styles.input}
          label={'Email'}
          value={this.state.email}
          onChangeText={(email) => {this.setState({email})}}
          keyboardType={'email-address'}
          orientation={'vertical'}
        />

        <InputWithLabel style={styles.input}
          label={'Phone'}
          value={this.state.phone}
          onChangeText={(phone) => {this.setState({phone})}}
          keyboardType={'phone-pad'}
          orientation={'vertical'}
        />

        <InputWithLabel style={[styles.input, {height: 140, textAlignVertical: 'top'}]}
          label={'Address'}
          value={this.state.address}
          onChangeText={(address) => {this.setState({address})}}
          orientation={'vertical'}
          multiline={true}
        />

        <InputWithLabel style={styles.input}
          label={'Postcode'}
          value={this.state.postcode}
          onChangeText={(postcode) => {this.setState({postcode})}}
          keyboardType={'numeric'}
          orientation={'vertical'}
        />

        <InputWithLabel style={styles.input}
          label={'City'}
          value={this.state.city}
          onChangeText={(city) => {this.setState({city})}}
          orientation={'vertical'}
        />

        <PickerWithLabel style={styles.picker}
          label={'State'}
          items={common.states}
          mode={'dialog'}
          value={this.state.state}
          onValueChange={(itemValue, itemIndex) => {
            this.setState({state: itemValue})
          }}
          orientation={'vertical'}
          textStyle={{fontSize: 24}}
        />

        <AppButton style={styles.button}
          title={'Update'}
          theme={'primary'}
          onPress={this._update}
        />

      </ScrollView>
    );
  }

}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 20,
    backgroundColor: '#fff',
  },
  input: {
    fontSize: 16,
    color: '#000099',
    marginTop: 10,
    marginBottom: 10,
  },
  picker: {
    color: '#000099',
    marginTop: 10,
    marginBottom: 10,
  },
  button: {
    marginTop: 10,
    marginBottom: 50,
  },
});
