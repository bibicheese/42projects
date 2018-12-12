/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_sort_wordtab.c                                  :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/22 11:14:24 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/22 11:24:26 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

int		ft_strcmp(char *s1, char *s2)
{
	int i;

	i = 0;
	while (s1[i] != '\0' || s2[i] != '\0')
	{
		if (s1[i] != s2[i])
			return (s1[i] - s2[i]);
		i++;
	}
	return (0);
}

void	ft_sort_wordtab(char **tab)
{
	int		i;
	int		n;
	char	*stock;

	i = -1;
	while (tab[++i])
	{
		n = i;
		while (tab[++n])
		{
			if (ft_strcmp(tab[i], tab[n]) > 0)
			{
				stock = tab[i];
				tab[i] = tab[n];
				tab[n] = stock;
			}
		}
	}
}
