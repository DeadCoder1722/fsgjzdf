import socket
from socket import *

import urllib

def getLocation(zip, mcc):
    url = "http://dmartin.org:8026/merchantpoi/v1/merchantpoisvc.svc/merchantpoi?PostalCode=" + zip + "&MCCCode=" + mcc
    data = urllib.urlopen(url).read()
    return data

def sortData(data):
    dataset = data.split("</MerchantPOI>")
    length = len(dataset)
    count = 0
    place = []

    while (count < length - 2):
        city = ""
        name = ""
        addr = ""
        phone = ""
        state = ""

        temp = dataset[count].split("<CleansedCityName")
        if temp[1][0] == '>':
            temp1 = temp[1].split("</CleansedCityName>")
            city = temp1[0][1:]

        temp = dataset[count].split("<CleansedMerchantName")
        if temp[1][0] == '>':
            temp1 = temp[1].split("</CleansedMerchantName>")
            name = temp1[0][1:]

        temp = dataset[count].split("<CleansedMerchantStreetAddress")
        if temp[1][0] == '>':
            temp1 = temp[1].split("</CleansedMerchantStreetAddress>")
            addr = temp1[0][1:]

        temp = dataset[count].split("<CleansedMerchantTelephoneNumber")
        if temp[1][0] == '>':
            temp1 = temp[1].split("</CleansedMerchantTelephoneNumber>")
            phone = temp1[0][1:]

        temp = dataset[count].split("<CleansedStateProvidenceCode")
        if temp[1][0] == '>':
            temp1 = temp[1].split("</CleansedStateProvidenceCode>")
            state = temp1[0][1:]

        merc = [city, name, addr, phone, state]
        place.append(merc)
        count = 1 + count

    return place

def DecodedCharArrayFromByteStreamIn(stringStreamIn):
    #turn string values into opererable numeric byte values
    byteArray = [ord(character) for character in stringStreamIn]
    datalength = byteArray[1] & 127
    indexFirstMask = 2
    if datalength == 126:
        indexFirstMask = 4
    elif datalength == 127:
        indexFirstMask = 10
    masks = [m for m in byteArray[indexFirstMask : indexFirstMask+4]]
    indexFirstDataByte = indexFirstMask + 4
    decodedChars = []
    i = indexFirstDataByte
    j = 0
    while i < len(byteArray):
        decodedChars.append( chr(byteArray[i] ^ masks[j % 4]) )
        i += 1
        j += 1
    return decodedChars

genData = getLocation("10001", "5811")
data = sortData(genData)


serverSocket = socket(AF_INET, SOCK_STREAM)

server_Address = ("localhost", 8080)
serverSocket.bind(server_Address)
serverSocket.listen(5)

while True:
    print "waiting"
    connectionSocket, addr = serverSocket.accept()

    try:
        message = connectionSocket.recv(1024)
        strmess = DecodedCharArrayFromByteStreamIn(message)
        print strmess
        output = "hi jimmy"
        connectionSocket.send(output)
        connectionSocket.close()
    except IOError:
        print('error')
        connectionSocket.close()

serverSocket.close()