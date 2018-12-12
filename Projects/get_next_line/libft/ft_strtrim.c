/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strtrim.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/27 14:14:31 by jmondino          #+#    #+#             */
/*   Updated: 2018/12/02 17:48:21 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

static size_t	ft_nospaces(char const *s)
{
	size_t	i;
	size_t	count;

	i = 0;
	count = 0;
	while (TRIMSPACES(s[i]))
		i++;
	if (s[i] == '\0')
		return (0);
	while (s[i])
	{
		count++;
		i++;
	}
	while (TRIMSPACES(s[i - 1]))
	{
		count--;
		i--;
	}
	return (count);
}

char			*ft_strtrim(char const *s)
{
	char	*str;
	size_t	i;
	size_t	j;

	if (s)
	{
		if (!(str = (char *)malloc(sizeof(char) * ft_nospaces(s) + 1)))
			return (NULL);
		i = 0;
		j = 0;
		while (TRIMSPACES(s[i]))
			i++;
		while (s[i])
			str[j++] = s[i++];
		while (TRIMSPACES(s[i - 1]))
		{
			str[j] = '\0';
			j--;
			i--;
		}
		str[j] = '\0';
		return (str);
	}
	return (NULL);
}
