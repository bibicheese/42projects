/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strsplit.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/27 16:14:29 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/17 16:59:22 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

static size_t		ft_len(char const *s, char c)
{
	size_t	count;

	count = 0;
	if (s)
	{
		while (*s == c)
			s++;
		while (*s != c && *s)
		{
			count++;
			s++;
		}
	}
	return (count);
}

static size_t		ft_words(char const *s, char c)
{
	int		i;
	size_t	count;
	size_t	bool;

	i = -1;
	count = 0;
	bool = 0;
	if (s)
	{
		while (s[++i])
		{
			if (s[i] == c)
				bool = 0;
			else
			{
				if (bool == 0)
					count++;
				bool = 1;
			}
		}
	}
	return (count);
}

char				**ft_strsplit(char const *s, char c)
{
	char	**tab;
	char	*str;
	size_t	i;
	size_t	j;
	int		k;

	if (!(tab = (char **)malloc(sizeof(char *) * (ft_words(s, c) + 1))))
		return (NULL);
	str = (char *)s;
	i = 0;
	k = 0;
	while (i < ft_words(s, c))
	{
		if (!(tab[i] = (char *)malloc(sizeof(char) * (ft_len(str, c) + 1))))
			return (NULL);
		j = 0;
		while (str[k] == c)
			k++;
		while (str[k] != c && str[k])
			tab[i][j++] = k++;
		tab[i][j] = '\0';
		i++;
	}
	tab[i] = NULL;
	return (tab);
}
