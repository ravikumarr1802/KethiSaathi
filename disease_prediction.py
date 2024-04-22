#!/usr/bin/env python
# coding: utf-8

# In[1]:


import os

def total_files(folder_path):
    num_files = len([f for f in os.listdir(folder_path) if os.path.isfile(os.path.join(folder_path, f))])
    return num_files

train_files_healthy = "C:\\Users\\Sricharan Reddy\\Downloads\\plant_disease_detection-main\\plant_disease_detection-main\\Dataset\\Train\\Train\\Healthy"
train_files_powdery = "C:\\Users\\Sricharan Reddy\\Downloads\\plant_disease_detection-main\\plant_disease_detection-main\\Dataset\\Train\\Train\\Powdery"
train_files_rust = "C:\\Users\\Sricharan Reddy\\Downloads\\plant_disease_detection-main\\plant_disease_detection-main\\Dataset\\Train\\Train\\Rust"

test_files_healthy = "C:\\Users\\Sricharan Reddy\\Downloads\\plant_disease_detection-main\\plant_disease_detection-main\\Dataset\\Test\\Test\\Healthy"
test_files_powdery = "C:\\Users\\Sricharan Reddy\\Downloads\\plant_disease_detection-main\\plant_disease_detection-main\\Dataset\\Test\\Test\\Powdery"
test_files_rust = "C:\\Users\\Sricharan Reddy\\Downloads\\plant_disease_detection-main\\plant_disease_detection-main\\Dataset\\Test\\Test\\Rust"

valid_files_healthy = "C:\\Users\\Sricharan Reddy\\Downloads\\plant_disease_detection-main\\plant_disease_detection-main\\Dataset\\Validation\\Validation\\Healthy"
valid_files_powdery = "C:\\Users\\Sricharan Reddy\\Downloads\\plant_disease_detection-main\\plant_disease_detection-main\\Dataset\\Validation\\Validation\\Powdery"
valid_files_rust = "C:\\Users\\Sricharan Reddy\\Downloads\\plant_disease_detection-main\\plant_disease_detection-main\\Dataset\\Validation\\Validation\\Rust"

print("Number of healthy leaf images in training set", total_files(train_files_healthy))
print("Number of powder leaf images in training set", total_files(train_files_powdery))
print("Number of rusty leaf images in training set", total_files(train_files_rust))

print("========================================================")

print("Number of healthy leaf images in test set", total_files(test_files_healthy))
print("Number of powder leaf images in test set", total_files(test_files_powdery))
print("Number of rusty leaf images in test set", total_files(test_files_rust))

print("========================================================")

print("Number of healthy leaf images in validation set", total_files(valid_files_healthy))
print("Number of powder leaf images in validation set", total_files(valid_files_powdery))
print("Number of rusty leaf images in validation set", total_files(valid_files_rust))


# In[2]:


from PIL import Image
import IPython.display as display

image_path = "C:\\Users\\Sricharan Reddy\\Downloads\\plant_disease_detection-main\\plant_disease_detection-main\\Dataset\\Train\\Train\Healthy\9fd8a0ed6cc0b352.jpg"

with open(image_path, 'rb') as f:
    display.display(display.Image(data=f.read(), width=500))


# In[3]:


image_path = "C:\\Users\\Sricharan Reddy\\Downloads\\plant_disease_detection-main\\plant_disease_detection-main\\Dataset\\Train\\Train\\Rust\\f3b19b71a064687c.jpg"

with open(image_path, 'rb') as f:
    display.display(display.Image(data=f.read(), width=500))


# In[10]:


pip install --upgrade numpy


# In[4]:


pip install --upgrade tensorflow keras


# In[5]:


from keras.preprocessing.image import ImageDataGenerator

train_datagen = ImageDataGenerator(rescale=1./255, shear_range=0.2, zoom_range=0.2, horizontal_flip=True)
test_datagen = ImageDataGenerator(rescale=1./255)


# In[6]:


train_generator = train_datagen.flow_from_directory("C:\\Users\\Sricharan Reddy\\Downloads\\plant_disease_detection-main\\plant_disease_detection-main\\Dataset\\Train\\Train",
                                                    target_size=(225, 225),
                                                    batch_size=32,
                                                    class_mode='categorical')

validation_generator = test_datagen.flow_from_directory("C:\\Users\\Sricharan Reddy\\Downloads\\plant_disease_detection-main\\plant_disease_detection-main\\Dataset\\Validation\\Validation",
                                                        target_size=(225, 225),
                                                        batch_size=32,
                                                        class_mode='categorical')


# In[ ]:


from keras.models import Sequential
from keras.layers import Conv2D, MaxPooling2D, Flatten, Dense


model = Sequential()
model.add(Conv2D(32, (3, 3), input_shape=(225, 225, 3), activation='relu'))
model.add(MaxPooling2D(pool_size=(2, 2)))
model.add(Conv2D(64, (3, 3), activation='relu'))
model.add(MaxPooling2D(pool_size=(2, 2)))
model.add(Flatten())
model.add(Dense(64, activation='relu'))
model.add(Dense(3, activation='softmax'))


# In[ ]:


model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])


# In[ ]:


history = model.fit(train_generator,
                    batch_size=16,
                    epochs=5,
                    validation_data=validation_generator,
                    validation_batch_size=16
                    )


# In[14]:


from matplotlib import pyplot as plt
from matplotlib.pyplot import figure

import seaborn as sns
sns.set_theme()
sns.set_context("poster")

figure(figsize=(25, 25), dpi=100)

plt.plot(history.history['accuracy'])
plt.plot(history.history['val_accuracy'])
plt.title('model accuracy')
plt.ylabel('accuracy')
plt.xlabel('epoch')
plt.legend(['train', 'val'], loc='upper left')
plt.show()


# In[15]:


model.save("model.h5")


# In[16]:



from tensorflow.keras.preprocessing.image import load_img, img_to_array
import numpy as np

def preprocess_image(image_path, target_size=(225, 225)):
    img = load_img(image_path, target_size=target_size)
    x = img_to_array(img)
    x = x.astype('float32') / 255.
    x = np.expand_dims(x, axis=0)
    return x

x = preprocess_image('Dataset/Test/Test/Rust/82f49a4a7b9585f1.jpg')


# In[17]:


predictions = model.predict(x)
predictions[0]


# In[18]:


labels = train_generator.class_indices
labels = {v: k for k, v in labels.items()}
labels


# In[19]:


predicted_label = labels[np.argmax(predictions)]
print(predicted_label)


# In[ ]:




