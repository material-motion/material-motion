---
layout: page
permalink: /starmap/specifications/streams/operators/
---

# Operators

## Vocabulary

### **From upstream** vs **incoming** 

Prefer "incoming" to avoid the upstream concept.

Example:

```
public interface Operation<T, U> {}
```

An operation is able to transform **incoming** values before choosing whether or not to pass them downstream.

### **To downstream** vs **to the observer**

Prefer "to the observer" to avoid the downstream concept. If there is no obvious observer in the surrounding context, prefer "to downstream".

Example:

```
public interface Operation<T, U> {}
```

An operation is able to transform incoming values before choosing whether or not to pass them **downstream**.

```
void next(MotionObserver<U> observer, T value);
```

Transforms the incoming value before passing it **to the observer**, or blocks the value.
