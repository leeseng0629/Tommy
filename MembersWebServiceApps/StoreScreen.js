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

let config = require('./Config.js');
let common = require('./CommonData.js');

type Props = {};
export default class StoreScreen extends Component<Props> {
  static navigationOptions = {
    title: 'Add Member',
  };

  constructor(props) {
    super(props);

    this.state = {
      name: '',
      email: '',
      phone: '',
      address: '',
      postcode: '',
      city: '',
      state: '14',
    };

    this._store = this._store.bind(this);
  }

  _store() {
    let url = config.settings.serverPath + '/api/members';

    fetch(url, {
      method: 'POST',
      headers: {
        Accept: 'application/json',
        'Content-type': 'application/json',
      },
      body: JSON.stringify({
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

      return response.json()
    })
    .then( (responseJson) => {
      if(responseJson.affected > 0) {
        Alert.alert('Record Saved', 'Record for `' + this.state.name + '` has been saved');
      }
      else {
        Alert.alert('Error saving record');
      }

      this.props.navigation.getParam('refresh')();
      this.props.navigation.goBack();
    })
    .catch( (error) => {
      console.error(error);
    });
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
          title={'Save'}
          theme={'primary'}
          onPress={this._store}
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
